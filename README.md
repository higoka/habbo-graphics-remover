# habbo-graphics-tag

a tiny script to add or remove graphics tag from swfs

## requirement

- php 7.1 or higher 
- jdk 8

## usage

```shell
php index.php [add OR remove] [path to file OR directory]
```

add graphics tag
```shell
php index.php add /path/to/file.swf
```

remove graphics tag
```shell
php index.php remove /path/to/file.swf
```

also works with swfs insde a directory
```shell
php index.php remove /path/to/directory
```
