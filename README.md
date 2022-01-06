<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Wasa Team pretest project

## Environment
* Laravel 8.55
* PHP 7.3
* MySQL 5.7

## Setup 
```
composer i

php artisan key:generate

// 生成jwt key
php artisan jwt:secret

php artisan migrate --seed
```

## 權限登記(預設)
* 一般使用者
  * list_post
  * read_post
* 編輯者
  * create_post
  * update_post
  * delete_post

## Testing user account & pwd
* user01 (field_id = 1)
  * account: test01
  * pwd: 123456
  * permission:
    * 一般使用者
    * 編輯者
* user02 (field_id = 2)
  * account: test02
  * pwd: 123456
  * permission:
    * 一般使用者
* user03 (field_id = 3)
  * account: test03
  * pwd: 123456
  * permission:
    * 一般使用者
## 權限想法說明
因需求中有提到權限有以下要求：
* 未登入使用者無法使用
* 不同權限角色使用者權限不同
* 使用者無法使用或者查看其他領域的資料

故因為希望在Service都能維持較單一的指責，所以將所有需要驗證權限的相關動作都擺在middleware來進行處理，主要為以下三個middleware：
* RefreshToken
  * 實作auth-jwt套件，並撰寫完整的驗證流程，使用者如果沒有登入獲取的token，便無法繼續動作。
  * 結合Refresh token的機制，使得使用者token到期(但存活期還未超過)的時候，可以無感的替換token。
* AuthUserPermission
  * 透過user_roles 和roles 兩張table，透過關聯可將使用者擁有的全部權限角色與其權限調用出來，在這去與route 的name做比較，達到權限管理的目的。
  * 後續當新的權限出來的時候，只需維護user_roles 與roles兩張table，減少更動程式邏輯的機會，降低維護成本。
* CheckUserField
  * 透過傳進來的field_id來判斷該使用者有沒有讀取這篇文章的權限。
  * create與index的時候沒有傳入id，但可透過auth取得user的資料，將限制該領域的使用者只能新增or查詢同領域的資料，降低造成錯誤的機會。



