# PHP HTTP 客户端测试

PHP 界的 HTTP 客户端性能测试

## 测试对象

参与测试的分别是：Guzzle、Saber 以及 YurunHttp

### Guzzle

Guzzle 是老牌 PHP HTTP 客户端，许多国内外的 SDK 都用它来封装。

但 Guzzle 对 Swoole 毫不兼容，很多 Swoole 用户为此感到十分头疼。

Guzzle-Swoole 解决方案：<https://github.com/Yurunsoft/Guzzle-Swoole>

项目地址：https://github.com/guzzle/guzzle

### Saber

Saber 是目前 Swoole 二号大佬 Twosee 开发的 PHP 高性能 HTTP 客户端, 基于 Swoole 原生协程

项目地址：<https://github.com/swlib/saber>

### YurunHttp

YurunHttp 是由宇润开源的 PHP HTTP 类库，支持链式操作，简单易用。

支持所有常见的 GET、POST、PUT、DELETE、UPDATE 等请求方式，支持 Http2、WebSocket、浏览器级别 Cookies 管理、上传下载、设置和读取 header、Cookie、请求参数、失败重试、限速、代理、证书等。

支持 Curl 和 Swoole 环境智能识别兼容。

项目地址：<https://github.com/Yurunsoft/YurunHttp>

## 测试服务器

文件 `test-server/server` 是今天测试用的服务端，它是一个 Go 的 hello world 服务器

不用 php-fpm 和 Swoole 是为了避免有人说，Swoole 客户端对 Swoole 写的服务端有迷之加成

所以采用了 PHP 公敌 Go 语言开发的服务器

`test-server/server.go` 是源代码，你也可以自行编译

## 测试内容

测试分为两类

循环请求 1W 次

并发请求 1W 次

由于 YurunHttp 支持 Curl 和 Swoole

所以会分别有 Curl 和 Swoole 的循环、并发测试

## 测试

### 测试环境

腾讯云，4核，4G 内存

Debian 版本: 8.6

Linux 版本: 3.16

PHP 版本: 7.1.33

php-curl 版本: 7.38.0

Swoole 版本: 4.4.16

### 测试命令

启动服务器：`./test-server/server`

启动测试：`./run-test.sh`

### 运行结果

```shell
---single---

guzzle:
Use time: 2.7100119590759s
success:10000, fail: 0

saber:
Use time: 2.7702579498291s
success:10000, fail: 0

yurunhttp-swoole:
Use time: 1.6949279308319s
success:10000, fail: 0

yurunhttp-curl:
Use time: 2.0800280570984s
success:10000, fail: 0

---batch---

guzzle-batch:
Use time: 7.3922648429871s
success:10000, fail: 0

saber-batch:
Use time: 1.4752199649811s
success:10000, fail: 0

yurunhttp-curl-batch:
Use time: 3.2565279006958s
success:10000, fail: 0

yurunhttp-swoole-batch:
Use time: 1.2161870002747s
success:10000, fail: 0
```

### 测试结果排行

#### 循环 1W 请求测试排行

| 排行 | 名称 | 时间（单位：秒） | 环境 |
|-|-|-|-|
| 1 | yurunhttp-swoole | 1.69s | Swoole |
| 2 | yurunhttp-curl | 2.08s | Curl |
| 3 | guzzle | 2.71s | Curl |
| 4 | saber | 2.77s | Swoole |

#### 并发 1W 请求测试排行

| 排行 | 名称 | 时间（单位：秒） | 环境 |
|-|-|-|-|
| 1 | yurunhttp-swoole | 1.21s | Swoole |
| 2 | saber | 1.47s | Swoole |
| 3 | yurunhttp-curl | 3.25s | Curl |
| 4 | guzzle | 7.39s | Curl |
