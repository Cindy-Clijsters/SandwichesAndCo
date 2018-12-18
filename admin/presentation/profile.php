<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Beheer {{ companyName }} :: Mijn profiel</title>
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
                                        <h4>Mijn gegevens</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                Voornaam:
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                {{ administrator.firstName }}
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                Achternaam:
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                {{ administrator.lastName }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                E-mail:
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                <a href="mailto:{{ administrator.email }}">{{ administrator.email }}</a>
                                            </div>
                                        </div>  
                                        
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                Status:
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                {{ translateAdministratorStatus(administrator.status) }}
                                            </div>
                                        </div>  
                                        
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                Actief sinds:
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                {{ administrator.createdAt|date('d-m-Y H:i:s') }}
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="profileEdit.php" class="btn btn-sm btn-primary mt-4" tabindex="1" autofocus>Mijn gegevens wijzigen</a>
                                            </div>
                                        </div>                                        
                                        
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