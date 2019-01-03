<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Beheer {{ companyName }} :: Bedrijfsprofiel</title>
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
                        <div>Bedrijfsprofiel</div>
                    </h1>
                    
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Bedrijfsgegevens</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                Naam:
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                {{ companyName }}
                                            </div>
                                        </div>                                     
                                        
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                Adres:
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                {{ company.address }}
                                            </div>
                                        </div>     
                                        
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                Postcode:
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                {{ company.postalCode }}
                                            </div>
                                        </div>      
                                        
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                Gemeente:
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                {{ company.city }}
                                            </div>
                                        </div>                                         
                                        
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                Telefoon:
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                <a href="tel:{{ company.telephone }}">{{ company.telephone }}</a>
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                E-mail:
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                <a href="mailto:{{ company.email }}">{{ company.email }}</a>
                                            </div>
                                        </div>   
                                        
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                Btw-nummer:
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                {{ company.vatNumber }}
                                            </div>
                                        </div>                                           
                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="companyProfileEdit.php" class="btn btn-sm btn-primary mt-4" tabindex="1" autofocus>Bedrijfsgegevens wijzigen</a>
                                            </div>
                                        </div>                                          
                                    </div>
                                </div>                           
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Sociale media</h4>
                                    </div>
                                    <div class="card-body">                                            
                                        <a href="socialMediaLinkCreate.php" class="btn btn-action btn-primary">Een nieuwe social media link toevoegen</i></a>
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