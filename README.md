# 十佳歌手报名系统

* `cp config.php.example config.php` 并修改配置文件中的数据库信息。
* `php database.php` 来创建数据库。
* `mkdir photos && chmod -R 777 photos` 使得可以上传照片。
* `mkdir csv && chmod -R 777 csv` 使得可以下载名单。
* 根目录为`dist`，设置rewrite来进行首页跳转。
  ```
  RewriteEngine on
  RewriteRule ^/$ /html/index.html [L]
  RewriteRule ^/(.*).html$ /html/$1.html
  ```
