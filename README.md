# Laravel Eloquent Composite Primary Keys

为 Laravel 的 Eloquent 数据库模型提供复合主键支持

Make Laravel Eloquent Database Support Composite Primary Keys

# 介绍

因为个人需求，需要在 Laravel 的 Eloquent 系统中使用复合主键。但是，Laravel 官方坚持不加入这一功能，并且似乎也不决定今后加入。

参考 [https://github.com/laravel/framework/issues/5355#issuecomment-161376267]

虽然，~~我有个朋友~~建议我使用数据库视图或者修改旧有表结构来完成，但无奈因为业务需求，很难达成这一点。

在网上搜索很久，大部分解决方案要么过期了（不支持最新的 Laravel 或最新 PHP 版本），要么无法工作。

故根据 Github 上现有项目进行魔改了本项目。可以让 Laravel 9.0 的 Eloquent 支持复合主键

# 需求

- PHP >= 8.0
- Laravel >= 9.0 或独立运行的 Eloquent >= 9.25 （没错，Eloquent 是可以脱离 Laravel 单独运行的哦！）

# 实现

- Find() 正常工作
- Save() 正常工作

# 注意

本项目未经大范围测试，也没有经过性能评估（毕竟是魔改了 Laravel 内部结果，根据我写 P社Mod 的经验……谁知道会造成什么卡顿问题呢）。

因此，**建议**只将本项目用于个人学习使用，**不推荐**用于正式商业项目

# Thanks

[https://github.com/thiagoprz/eloquent-composite-key]

[https://github.com/mpociot/laravel-composite-key]

[https://stackoverflow.com/questions/60145867/how-to-create-composite-key-in-orm-eloquent-laravel-6-2]

# License

MIT