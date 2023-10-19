**Todo Api Test**

**Email:** test@todo.com

**Password:** secret 

**API Setup :**

Add Necessary Database credentials in the .env  

Run : **php artisan db:seed**

To create the seeded user in the db 

Login in with the credentials 

The email and password are provided above 

**Endpoints :**

Check **api.php** for endpoint

BaseURl : Based on environmental setup , in my case its 
- **https://todo_project.test/api/v1** in some cases it will be 
a localhost address **http://localhost:8000/api/v1**

- Authenticate 
- baseurl+/authenticate/authenticate
  - email 
  - password
  - POST Method

- Fetch List of Todos
  - baseUrl+ /todos/my-todos
  - GET Method

- Create Todos
  - baseUrl + /todos/create
    - title
    - to - Date Format - ( Y - m - d )
    - from  - Date Format - ( Y - m - d )
  - POST Method

- Mark Todo as Complete
  - baseUrl + /mark-as-complete/{todo_id}
  - {todo_id} an ID of the selected todo
  - GET Method

- Delete Todo
  - baseUrl + /delete/{todo_id}
  - {todo_id} an ID of the selected todo
  - Delete Method
