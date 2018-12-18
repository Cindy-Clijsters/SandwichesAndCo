<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Beheer {{ companyName }} :: Mijn gegevens wijzigen</title>
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
                                        <h4>Mijn gegevens wijzigen</h4>
                                    </div>
                                    <div class="card-body">
                                        
                                        {% if successMessage is defined %}
                                            <div class="alert alert-success">{{ successMessage }}</div>
                                        {% endif %}
                                        
                                        <form action="profileEdit.php" method="post" novalidate>
                                            
                                            <div class="form-group">
                                                <label for="firstName">Voornaam <i class="ion ion-android-star"></i></label>
                                                <input type="input" class="form-control {% if errors.firstName is defined %}is-invalid{% endif %}" id="first-name" name="first-name" value="{{ firstName }}" tabindex="1" autofocus>
                                                {% if errors.firstName is defined %}
                                                    <div class="invalid-feedback">{{ errors.firstName }}</div>
                                                {% endif %}
                                            </div>

                                            <div class="form-group">
                                                <label for="lastName">Achternaam <i class="ion ion-android-star"></i></label>
                                                <input type="input" class="form-control {% if errors.lastName is defined %}is-invalid{% endif %}" id="last-name" name="last-name" value="{{ lastName }}" tabindex="2">
                                                {% if errors.lastName is defined %}
                                                    <div class="invalid-feedback">{{ errors.lastName }}</div>
                                                {% endif %}                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="email">E-mail <i class="ion ion-android-star"></i></label>
                                                <input type="email" class="form-control {% if errors.email is defined %}is-invalid{% endif %}" id="email" name="email" value="{{ email }}" tabindex="3">
                                                {% if errors.email is defined %}
                                                    <div class="invalid-feedback"><?php echo $errors->email; ?></div>
                                                {% endif %}
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary mt-2" tabindex="4">Wijzigen</button>
                                                <a href="profile.php" class="btn btn-sm btn-outline-primary mt-2" tabindex="5">Annuleren</a>
                                            </div>
                                            
                                            <small><i>Velden met een <i class="ion ion-android-star"></i> zijn verplicht.<i></small>
                                            
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