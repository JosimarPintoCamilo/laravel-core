# Como utilizar
Você precisará de uma tabela chamada 'users' em seu banco de dados.

## routes/api.php
```php
use JosimarCamilo\LaravelCore\Controllers\UserController;

Route::post('/users', [UserController::class, 'store']);
Route::post('/users/token', [UserController::class, 'storeToken']);
```
## Requests e responses
Create user
```/api/users```
```json
{
	"name": "Josimar",
	"email": "josimar3@gmail.com",
	"password":"qwer1234",
	"token_name": "token"
}
```
Response
```json
{
	"name": "Josimar",
	"email": "josimar3@gmail.com",
	"updated_at": "2022-09-08T20:43:25.000000Z",
	"created_at": "2022-09-08T20:43:25.000000Z"
}
```
Create token
```/api/users/token```
```json
{
	"email": "josimar3@gmail.com",
	"password": "qwer1234",
	"token_name": "token"
}
```
Response
```json
{
	"token": "3|6O6uIKCXqHJovAVeE2GzrOT1hLoYYOXRImK1fHrj"
}
```