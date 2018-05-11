## Laravel Dictionary Extends


### 快速使用

#### 模型定义

```
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Phpno1\Dictionaries\Supports\Trans;

class Goods extends Model
{
    use Trans;//引入trait
}

```

#### 配置映射字典

```
//config/dictionaries.php

return [
    'tags'=>[
        '1'=>'进口食品',
        '2'=>'奶制品',
    ],
    'recommend'=>[
        '1'=>'是',
        '2'=>'否',
    ]
];
    
```


### 数据转化

#### 单条数据转化

```
    //单条数据转化 
    Route::get('/', function () {
        $result=(new \App\Goods)->first();
        //原始数据
        array:4 [▼
          "id" => 1
          "name" => "测试商品"
          "tags" => "1,2,3" //或者 ['1',2','3']
          "recommend" => "1"
        ]
        
        //转化  返回字符串
        $result->tags_title=$result->mapping('tags');
        $result->recommend_title=$result->mapping('recommend');       
        //转化后数据  
        array:6 [▼
          "id" => 1
          "name" => "测试商品"
          "tags" => "1,2,3"
          "recommend" => "1"
          "tags_title" => "进口食品,奶制品"
          "recommend_title" => "是"
        ]  
        
        //转化  返回数组
        $result->tags_title=$result->mappingArray('tags');
        $result->recommend_title=$result->mappingArray('recommend');
        //转化后数据  
        array:6 [▼
          "id" => 1
          "name" => "测试商品"
          "tags" => "1,2,3"
          "recommend" => "1"
          "tags_title" => array:2 [▼
            1 => "进口食品"
            2 => "奶制品"
          ]
          "recommend_title" => array:1 [▼
            1 => "是"
          ]
        ]
    });
    
   
```

#### 集合数据转化

```
    Route::get('/', function () {
        $result=(new \App\Goods)->first();
        $result->tags_title=$result->tagTrans('tags');
        $result->recommend_title=$result->tagTrans('recommend');
        dd($result);
    });
```

#### 分页数据转化

```
    Route::get('/', function () {
        $result=(new \App\Goods)->first();
        $result->tags_title=$result->tagTrans('tags');
        $result->recommend_title=$result->tagTrans('recommend');
        dd($result);
    });
```
