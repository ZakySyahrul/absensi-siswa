<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      padding-top: 50px;
    }

    .form-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
      color: #007bff;
      text-align: center;
      margin-bottom: 30px;
    }

    .form-container .form-control {
      border-radius: 10px;
      border-color: #ced4da;
    }

    .form-container .btn-primary {
      border-radius: 10px;
      transition: background-color 0.3s ease;
      width: 100%;
      /* Make the button full width */
    }

    .form-container .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
  </style>
</head>

<body>
  @if ($errors->has('username'))
  <div class="alert alert-danger alert-dismissible fade show mx-auto" role="alert" style="max-width: 550px;">
    {{ $errors->first('username') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="form-container">
          <h2>Register</h2>
          <form action="/register" method="POST">
            @csrf
            <div class="mb-3">
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Guru" required>
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="mb-3">
              <select class="form-select" id="role" name="role" required>
                <option value="">Role</option>
                <option value="Guru">Guru</option>
                <option value="Admin">Admin</option>
                <option value="Kedisiplinan">Kedisiplinan</option>
              </select>
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-primary">Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
</body>

</html>