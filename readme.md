## Laravel 数据字典扩展包

### 功能
<p>数据映射字典转化。</p>

### 官方扩展qq群
    qq:680531281

- <a href="#安装">安装</a>
    - <a href="#使用要求">使用要求</a>
    - <a href="#composer">composer</a>
    - <a href="#laravel">laravel</a>
- <a href="#配置">配置</a>    
    - <a href="#模型定义">模型定义</a>    
    - <a href="#设置字典">设置字典</a>    
- <a href="#方法">方法</a>
- <a href="#数据转化">数据转化</a>
    - <a href="#单个字段字典映射">单个字段字典映射</a>
    - <a href="#多个字段字典映射">多个字段字典映射</a>
- <a href="#注意事项">注意事项</a>

### 使用要求

- laravel >= 5.*    
- php     >= 7

### composer
执行以下命令获取包的最新版本:

```php
    composer require phpno1/dictionary
```

### laravel

#### 生成配置文件
```php
    php artisan vendor:publish --provider "Phpno1\Dictionaries\Providers\DictionaryProvider"
```

#### > = laravel5.5
ServiceProvider将自动附加

#### 其他版本
```php
'providers' => [
    Phpno1\Dictionaries\Providers\DictionaryProvider::class,
]
```
### 配置 

#### 模型定义

```php

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Phpno1\Dictionaries\Supports\Mapping;

class Goods extends Model
{
    use Mapping;//引入trait
}

```

#### 设置字典

```php
//config/dictionaries.php

return [

    'label'=>'label'//这里是多字段映射用到的
    
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

### 方法 

### mapping
```php 
    /**
     * @param string $fields
     * @param string $separator 默认值 ,分割方式
     * @return string
     */
    mapping('字段',"分割方式='默认是 , '");
```


### mappingArray

```php
    /**
     * @param string $fields
     * @param string $separator 默认值 ,分割方式
     * @return array
     */
    mappings('字段',"分割方式='默认是 , '");
```

### mappings
```php
    /**
     * @param array $fields
     * @param string $separator 默认值 ,分割方式
     * @return $this
     */
    mappings('字段',"分割方式='默认是 , '");
```

### mappingsArray
```php
    /**
     * @param array $fields
     * @param string $separator 默认值 ,分割方式
     * @return $this
     */
    mappingsArray('字段',"分割方式='默认是 , '");
```

### 数据转化

#### 单个字段字典映射

```php
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

```php
    Route::get('/', function () {
        $result=(new \App\Goods)->all();
        $result->transform(function($goods){
            $goods->tags_title=$goods->mapping('tags');
            $goods->recommend_title=$goods->mapping('recommend');
            return $goods;
        });
        dd($result->toArray());
    });
```

#### 分页数据转化

```php
    $result=(new \App\Goods)->paginate();
        $result->getCollection()->transform(function($goods){
        $goods->tags_title=$goods->mapping('tags');
        $goods->recommend_title=$goods->mapping('recommend');
        return $goods;
    });
    dd($result->toArray());
```

#### 多个字段字典映射

```php
    Route::get('/', function () {
        $result=(new \App\Goods)->first();
        
        //转化  返回字符串
        $result=$result->mappings(['tags','recommend']);
        dd($result->toArray());
        
        //转化  返回数组
        $result=$result->mappingsArray(['tags','recommend']);
        dd($result->toArray());
    });
```

#### 注意事项

+ 复杂数据映射请用单子段转化。
+ 数据映射字段和字典key要一致否则无法转化。
+ 字典配置文件label如果是空,转化原始字段则数据被覆盖。
