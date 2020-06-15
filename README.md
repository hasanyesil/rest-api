# rest-api
Müşterilerin sisteme login olmasını alışveriş yapmasını sağlamak için yazılmış bir rest api.
## Tech/framework used
- PHP 7.4.2 
    https://www.php.net/releases/7_4_2.php
- Symfony 4.4.9 
    https://www.php.net/releases/7_4_2.php
## Configuration
Uygulamanın çalışması için gerekli veritabanının ayarlanması 
*(rest-api/.env)*
```
DATABASE_URL=mysql://kullanıcı_adı:parola@127.0.0.1:myql_port/database_ismi?serverVersion=5.7
```
## Routes
- \/api\/login 
- \/api\/orders
- \/api\/orders/\{id\}
- \/api\/customers\/\{id\}\/orders\/orders.\{_format\}

## TASK LIST
- [x] Servisler
- [x] Postman Collection
- [x] Readme
- [ ] Unit Tests
- [ ] Docker image
