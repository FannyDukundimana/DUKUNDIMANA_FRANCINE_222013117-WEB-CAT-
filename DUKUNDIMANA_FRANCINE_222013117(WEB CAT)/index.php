<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home Page</title>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: url('2.jpg') center/cover no-repeat;
    background-blend-mode: overlay;
    height: 100vh;
  }

  .overlay {
    background-color: rgba(0, 0, 0, 0.5); 
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    position: relative;
    z-index: 1; 
  }

  .container {
    position: relative;
    z-index: 2; 
  }

  h1 {
    font-size: 3rem;
    margin-bottom: 20px;
  }

  p {
    font-size: 1.2rem;
    margin-bottom: 30px;
  }

  .btn {
    display: inline-block;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.2rem;
    text-decoration: none;
    color: #FFFFFF; 
    background-color: #007BFF; 
    transition: background-color 0.3s ease;
  }

  .btn:hover {
    background-color: #0056b3;
    box-shadow: 2px;
  }

  .btn-register {
    background-color: #000000; 
    margin-left: 20px;
  }

  .btn-register:hover {
    background-color: #333333; 
  }
</style>
</head>
<body>

<div class="overlay">
  <div class="container">
    <h1> Most Welcome to Our lib_management</h1>
    <p>Your one-stop destination for all your needs</p>
    <a href="login.html" class="btn">Login</a>
    <a href="register.html" class="btn btn-register">Register</a>
  </div>
</div>

</body>
</html>
