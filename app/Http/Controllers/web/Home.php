<?php

namespace App\Http\Controllers\web;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Question;

class Home extends BaseController
{

    public function doIndex($name = 'index',Request $request){
        $inputs = $request->all();
        switch ($name) {
            case 'index':
                $search = empty($inputs['search']) ? '' : $inputs['search'];
                $page = empty($inputs['page']) ? 1 : $inputs['page'];
                $lists = Question::list('home',$search,$page);
                $view = view('home/index',compact('lists','search'));
                break;
            case 'detail':
                list($question,$items) = $this->toDetial($inputs);
                $view = view('home/index',compact('question','items'));
                break;
            case 'delete':
                $this->deleteQst($inputs['qids']);
                return back()->withError('');
            default :
                $view = view('home/index');
                break;
        }
        return $view->with('_name',$name);
    }

    private function toDetial($inputs){
        $qid = $inputs['qid'];

        $question = DB::table('qst_question_list as list')
                        ->where('id','=',$qid)
                        ->first();
        $items = DB::table('qst_question_anwser')
                    ->where('qid','=',$qid)
                    ->get();
        $items->each(function(&$item,$key){
            if(!empty($item->thumb)){
                $mime_type= mime_content_type($item->thumb);
                $base64 = base64_encode(file_get_contents($item->thumb));
                $item->base64 = 'data:'.$mime_type.';base64,'.$base64;
            }
        });
        return [$question,$items];
    }

    public function doAdd(Request $request){

        $rules = $this->rules();
        $messages = $this->messages();
        $inputs = $request->all();
        if(!empty($inputs['batch'])){
            $types = ['xlsx','csv','xls'];
            $file = $inputs['batch'];
            $type = $file->getClientOriginalExtension();
            if(in_array($type,$types)){
                $this->batchAdd($file);
                return redirect('home')
                    ->with('success','添加成功');
            }else{
                 return back()->withErrors(['文件格式错误，请上传模板文件']);
            }
            
        }

        if(empty($inputs['submit'])){
            return back()->withErrors(['提交错误，请重试！'])->withInput();  
        }

        if(empty($inputs['title'])){
            return back()->withErrors(['请输入问题'])->withInput();  
        }

        $options = [];
        $optItems = ['item','check','file'];
        foreach($inputs as $key => $val){
            preg_match('/^(.*?)(\d+)$/',$key,$matches);
            if(empty($matches)){
                continue ;
            }
            $name = $matches[1];
            $num = $matches[2];
            if(in_array($name,$optItems)){
                if(empty($options[$num - 1])){
                    $options[] = [
                        $name => $val
                    ];
                }
                $options[$num - 1][$name] = $val;
            }
        }

        $hasAnwser = false;
        foreach($options as $optKey => $optVal){
            if(empty($optVal['item']) && empty($optVal['file'])){
                unset($options[$optKey]);
                continue;
            }
            if($optVal['check'] == 1){
                $hasAnwser = true;
            }
        }
        if(count($options) === 0){
            return back()->withErrors(['没有有效的选项'])->withInput();  
        }
        if(!$hasAnwser){
            return back()->withErrors(['该题目没有正确答案'])->withInput();  
        }

        $qid = @$inputs['qid'];
        if(empty($qid)){
            $qid = $this->itemAdd($options,$inputs['title']);
            $message = '添加成功！';
        }else{
            $this->itemUpdate($options,$inputs['title'],$inputs['qid']);
            $message = '更新成功！';
        }

        $url = url('home/detail').'?qid='.$qid;
        return redirect($url)
                ->with('success',$message);
    }

    private function batchAdd($file){
        Excel::load($file, function($reader) {
            $reader = $reader->getSheet(0);
            $data = $reader->toArray();

            $data = $this->excelToArray(array_slice($data,2));

        });
    }

    private function excelToArray($data){
        //dd($data);
        $options = [];

        foreach($data as $row){
            if(empty($row[0]) || empty(2)){
                continue ;
            }
            $title = $row[0];
            $asw = preg_split('/(,|，|\||\s)/',strtolower($row[2]));
            $items = array_slice($row,4);
            $allItems = [];
            foreach($items as $key => $value){
                $thisItem = [];
                if(empty($value)){
                    continue ;
                }
                $tmpRes = preg_split('/(\\n|\\r|\\n\\r)img(:|：)/',$value);
                if(count($tmpRes) > 1){
                    $thisItem = [
                        'title' => $tmpRes[0],
                        'thumb' => './'.substr($tmpRes[1],strpos($tmpRes[1],'upload'))
                    ];
                }else{
                    $thisItem = [
                        'title' => $tmpRes[0]
                    ];
                }
                $tmpKey = $this->toCharts($key + 4);
                if(in_array($tmpKey,$asw)){
                    $thisItem['is_right'] = 1;
                }
                $allItems[] = $thisItem;

            }
            $options[] = [
                'title' => $title,
                'items' => $allItems
            ];

        }

        foreach($options as $opts){
            $this->batchInsert($opts);
        }

    }

    private static function toCharts($num){
        $charts = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','y','v','w','x','y','z'];
        $total = count($charts);
        if($num < $total){
            return $charts[$num];
        }else{
            return self::toCharts(round($num/$total) - 1).$charts[$num%$total];
        }
    }

    private function batchInsert($opts){
        $listId = DB::table('qst_question_list')->insertGetId(
            [
                'title' => $opts['title'],
                'createtime' => time()
            ]
        );
        $insert = [];
        foreach($opts['items'] as $key => $item){
            $row = [
                'qid' => $listId
            ];

            $row['thumb'] = empty($item['thumb']) ? null : $item['thumb'];
            $row['title'] = empty($item['title']) ? null : $item['title'];
            $row['is_right'] = empty($item['is_right']) ? 0 : $item['is_right'];

            $insert[] = $row;
        }

        DB::table('qst_question_anwser')->insert($insert);

        $asw = DB::table('qst_question_anwser')
                ->select('id')
                ->where([
                    ['qid','=',$listId],
                    ['is_right','=',1]
                ])->get();

        DB::table('qst_question_list')
                ->where('id','=',$listId)
                ->update(['res'=>$asw->implode('id',',')]);
        return $listId;
    }

    private function itemAdd($opts,$title){
        $listId = DB::table('qst_question_list')->insertGetId(
            [
                'title' => $title,
                'createtime' => time()
            ]
        );
        $insert = [];
        foreach($opts as $key => $item){
            $row = [
                'qid' => $listId
            ];

            $row['thumb'] = empty($item['file']) ? null : $this->addFile($item['file'],$key);
            $row['title'] = empty($item['item']) ? null : $item['item'];
            $row['is_right'] = empty($item['check']) ? 0 : $item['check'];

            $insert[] = $row;
        }

        DB::table('qst_question_anwser')->insert($insert);

        $asw = DB::table('qst_question_anwser')
                ->select('id')
                ->where([
                    ['qid','=',$listId],
                    ['is_right','=',1]
                ])->get();

        DB::table('qst_question_list')
                ->where('id','=',$listId)
                ->update(['res'=>$asw->implode('id',',')]);
        return $listId;
    }

    private function itemUpdate($opts,$title,$qid){
        DB::table('qst_question_list')
            ->where('id','=',$qid)
            ->update([
                'title' => $title
            ]);
        DB::table('qst_question_anwser')
                    ->where('qid','=',$qid)
                    ->update([
                        'isdeleted' => 1
                    ]);
        $items = DB::table('qst_question_anwser')
                ->where('qid','=',$qid)
                ->get()
                ->all();
        $insert = [];

        foreach($opts as $key => $val){
            if(!empty($items[$key])){
                $data = [
                    'title' => empty($val['item']) ? null : $val['item'],
                    'thumb' => empty($val['file']) ? null : $this->addFile($val['file'],$key),
                    'is_right' => empty($val['check']) ? 0 : $val['check'],
                    'isdeleted' => 0
                ];
                DB::table('qst_question_anwser')
                    ->where('id','=',$items[$key]->id)
                    ->update($data);
            }else{
                $row = [
                    'qid' => $qid
                ];

                $row['thumb'] = empty($val['file']) ? null : $this->addFile($val['file'],$key);
                $row['title'] = empty($val['item']) ? null : $val['item'];
                $row['is_right'] = empty($val['check']) ? 0 : $val['check'];
                $insert[] = $row;
            }
        }
        if(count($insert) > 0){
            DB::table('qst_question_anwser')->insert($insert);
        }
        $asw = DB::table('qst_question_anwser')
                ->select('id')
                ->where([
                    ['qid','=',$qid],
                    ['is_right','=',1]
                ])->get();

        DB::table('qst_question_list')
                ->where('id','=',$qid)
                ->update(['res'=>$asw->implode('id',',')]);
    }

    private function addFile($base64,$key = 0){
        $base64 = trim($base64);
        $filename = date('YmdHis',time()).$key.'_'.mt_rand(1000,9999);
        $dirname = './upload/';
        $filename = md5($filename);

        if(!is_dir($dirname)){
            mkdir($dirname,0777);
        }
        if(preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64,$result)){
            $type = $result[2];

            if(in_array($type,['jpg','jpeg','png'])){
                $path = $dirname.$filename.'.'.$type;

                if(file_put_contents($path,base64_decode(str_replace($result[1],'',$base64)))){
                    return $path;
                }else{
                    return back()->withErrors(['第'.($key + 1).'个选项图片上传失败'])->withInput();
                }
            }else{
                return back()->withErrors(['第'.($key + 1).'个选项文件类型错误'])->withInput();    
            }
        }else{
            return back()->withErrors(['第'.($key + 1).'个选项文件错误'])->withInput();
        }
    }

    private function deleteQst($qids){
        $qids = explode(',',$qids);
        if(0 === count($qids)){
            return back()->withErrors('请选择要删除的问题');
        }
        foreach($qids as $key => $qid){
            $res = DB::table('qst_question_list')
                ->where('id','=',$qid)
                ->update([
                    'isdeleted' => 1
                ]);
            if(!$res){
                return back()->withErrors('第'.($key + 1).'个问题删除失败，该问题不存在');
            }
        }
        return redirect('home')->with('success','删除成功！');
    }

    public function messages(){
        return [
            'title.required' => '请输入问题'
        ];
    }

    public function rules(){
        return [
            'title' => 'required'
        ];
    }

}
