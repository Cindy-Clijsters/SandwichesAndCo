<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Beheer {{ companyName }} :: Mijn wachtwoord wijzigen</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <meta name="description" content="{{ companyName }}" />
    <meta name="keywords" content="{{ companyName }}, sandwiches, take away" />
    <meta name="author" content="Cindy Clijsters" />

    {{ include('includes/stylesheet.php') }}
    
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            
            {{ include('includes/header.php') }}
            {{ include('includes/menuSideBar.php') }}
            
            <div class="main-content">
                <section class="section">
                    <h1 class="section-header">
                        <div>Mijn profiel</div>
                    </h1>
                    
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Mijn wachtwoord wijzigen</h4>
                                    </div>
                                    <div class="card-body">
                                        
                                        {% if successMessage is not empty %}
                                            <div class="alert alert-success">{{ successMessage }}</div>
                                        {% endif %}
                                        
                                        <form action="passwordEdit.php" method="post" novalidate>
                                            
                                            <div class="form-group">
                                                <label for="old-password">Oud wachtwoord <i class="ion ion-android-star"></i></label>
                                                <input type="password" class="form-control {% if errors.oldPassword is defined %}is-invalid{% endif %}" id="old-password" name="old-password" tabindex="1" autofocus>
                                                {% if errors.oldPassword is defined %}
                                                    <div class="invalid-feedback">{{ errors.oldPassword }}</div>
                                                {% endif %}
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Wachtwoord <i class="ion ion-android-star"></i></label>
                                                <input type="password" class="form-control {% if errors.password is defined %}is-invalid{% endif %}" id="password" name="password" tabindex="2">
                                                {% if errors.password is defined %}
                                                    <div class="invalid-feedback">{{ errors.password }}</div>
                                                {% endif %}                                         
                                            </div>

                                            <div class="form-group">
                                                <label for="confirm-password">Wachtwoord bevestigen <i class="ion ion-android-star"></i></label>
                                                <input type="password" class="form-control {% if errors.confirmPassword is defined %}is-invalid{% endif %}" id="confirm-password" name="confirm-password" tabindex="3">
                                                {% if errors.confirmPassword is defined %}
                                                    <div class="invalid-feedback">{{ errors.confirmPassword }}</div>
                                                {% endif %} 
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary mt-2" tabindex="4">Wijzigen</button>
                                                <a href="profile.php" class="btn btn-sm btn-outline-primary mt-2" tabindex="5">Annuleren</a>
                                            </div>
                                            
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
            </div>

            {{ include('includes/footer.php') }}
            
        </div>
    </div>

    {{ include('includes/scripts.php') }}

</body>
</html>