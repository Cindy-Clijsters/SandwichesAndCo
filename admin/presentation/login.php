<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Beheer {{ company.name }} :: Aanmelden</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ company.name }}" />
    <meta name="keywords" content="{{ company.name }}, sandwiches, take away" />
    <meta name="author" content="Cindy Clijsters" />

    {{ include('includes/stylesheet.php') }}
</head>
    
<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            {{ company.name }}
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Aanmelden</h4>
                            </div>

                            <div class="card-body">
                                
                                <form action="login.php" method="post" novalidate>
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control {% if errors.email is defined %}is-invalid{% endif %}" name="email" id="email" value="{{ email }}" tabindex="1" autofocus>
                                        {% if errors.email is defined %}
                                            <div class="invalid-feedback">{{ errors.email }}</div>
                                        {% endif %}
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="d-block">Wachtwoord
                                            <div class="float-right">
                                                <a href="#">Wachtwoord vergeten?</a>
                                            </div>
                                        </label>
                                        <input type="password" class="form-control {% if errors.password is defined %}is-invalid{% endif %}" name="password" id="password" value="" tabindex="2">
                                        {% if errors.password is defined %}
                                            <div class="invalid-feedback">{{ errors.password }}</div>
                                        {% endif %}
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-primary">Aanmelden</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="simple-footer">
                            Copyright &copy; {{ "now"|date("Y") }} {{ company.name }} 
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{ include('includes/scripts.php') }}
    
</body>    
</html>