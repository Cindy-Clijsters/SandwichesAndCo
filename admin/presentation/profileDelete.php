<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Beheer {{ companyName }} :: Mijn profiel verwijderen</title>
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
                                        <h4>Mijn profiel verwijderen</h4>
                                    </div>
                                    <div class="card-body">
                                        
                                        {% if message is not empty %}
                                        
                                            {{ message|raw}}
                                        
                                        {% else %}
                                       
                                            <form action="profileDelete.php" method="post" novalidate>

                                                <p class="mb-4">Geef je wachtwoord in om je profiel te verwijderen.<br>
                                                <strong>Let op!</strong> Als je je profiel verwijdert, kan je dit niet meer herstellen.</p>

                                                <div class="form-group">
                                                    <label for="password">Wachtwoord <i class="ion ion-android-star"></i></label>
                                                    <input type="password" class="form-control {% if errors.password is defined %}is-invalid{% endif %}" id="password" name="password">
                                                    {% if errors.password is defined %}
                                                        <div class="invalid-feedback">{{ errors.password }}</div>
                                                    {% endif %}                                             
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm btn-danger mt-2"><i class="ion ion-alert mr-2"></i>Mijn profiel verwijderen</button>
                                                    <a href="profile.php" class="btn btn-sm btn-outline-primary mt-2">Annuleren</a>
                                                </div>

                                            </form>
                                        
                                        {% endif %}
                                        
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