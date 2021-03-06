### 简介
一个简单的yii2高级版例子，包含frontend,backend,api 三个应用，每个应用都是独立的应用，共用同一个common\models\User identity Class
#### 特点
* 集成了RBAC权限管理
* 用到了module实现api restful

### 安装
1. 克隆下来
   ```
   git clone https://github.com/chenlovexx/yii2-app-advanced/
   ``` 

2. 执行该目录下的 init 初始化配置（生成本地配置文件）
   ```
   init 
   ``` 
3. 配置好数据库配置后
   修改common/config/main-local.php里的数据库信息

4. 导入migration
  * 导入rbac migration 权限控制数据表
    ```
    yii migrate --migrationPath=@yii/rbac/migrations
    ```
  *  导入用户表数据
     ```
     yii migrate
     ```
### 配置三个应用的访问域名
1. 修改hosts文件添加frontend, backend和api三个域名
   ```
   127.0.0.1 frontend.test backend.test api.test
   ```
2. 修改apache vhost 
```   
<VirtualHost *:80>
    ServerName frontend.test
    DocumentRoot "path to yii2-app-advanced/frontend/web"
    ErrorLog "logs/frontend-error.log"
</VirtualHost>

<VirtualHost *:80>
    ServerName backend.test
    DocumentRoot "path to yii2-app-advanced/backend/web"
    ErrorLog "logs/backend-error.log"
</VirtualHost>

<VirtualHost *:80>
    ServerName api.test
    DocumentRoot "path to yii2-app-advanced/api/web"
    ErrorLog "logs/api-error.log"
</VirtualHost>
```

然后可以以frontend.test / backend.test / api.test 访问三个应用

测试api可以用Google的postman插件来测试

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
