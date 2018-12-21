<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Beheer {{ companyName }} :: Bedrijfsprofiel wijzigen</title>
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
                                        <h4>Bedrijfsgegevens wijzigen</h4>
                                    </div>
                                    <div class="card-body">
                                        
                                        {% if successMessage is not empty %}
                                            <div class="alert alert-success">{{ successMessage }}</div>
                                        {% endif %}
                                        
                                        <form action="companyProfileEdit.php" method="post" novalidate> 
                                            
                                            <div class="form-group">
                                                <label for="name">Naam <i class="ion ion-android-star"></i></label>
                                                <input type="input" class="form-control {% if errors.name is defined %}is-invalid{% endif %}" id="name" name="name" value="{{ tmpCompany.name }}" tabindex="1" autofocus>
                                                {% if errors.name is defined %}
                                                    <div class="invalid-feedback">{{ errors.name }}</div>
                                                {% endif %}
                                            </div>          

                                            <div class="form-group">
                                                <label for="address">Adres</label>
                                                <input type="input" class="form-control {% if errors.address is defined %}is-invalid{% endif %}" id="address" name="address" value="{{ tmpCompany.address }}" tabindex="2">
                                                {% if errors.address is defined %}
                                                    <div class="invalid-feedback">{{ errors.address }}</div>
                                                {% endif %}
                                            </div>

                                            <div class="form-group">
                                                <label for="postal-code">Postcode</label>
                                                <input type="input" class="form-control {% if errors.postalCode is defined %}is-invalid{% endif %}" id="postal-code" name="postal-code" value="{{ tmpCompany.postalCode }}" tabindex="3">
                                                {% if errors.postalCode is defined %}
                                                    <div class="invalid-feedback">{{ errors.postalCode }}</div>
                                                {% endif %}
                                            </div>     

                                            <div class="form-group">
                                                <label for="city">Gemeente</label>
                                                <input type="input" class="form-control {% if errors.city is defined %}is-invalid{% endif %}" id="city" name="city" value="{{ tmpCompany.city }}" tabindex="4">
                                                {% if errors.city is defined %}
                                                    <div class="invalid-feedback">{{ errors.city }}</div>
                                                {% endif %}
                                            </div> 

                                            <div class="form-group">
                                                <label for="telephone">Telefoon</label>
                                                <input type="input" class="form-control {% if errors.telephone is defined %}is-invalid{% endif %}" id="telephone" name="telephone" value="{{ tmpCompany.telephone}}" tabindex="5">
                                                {% if errors.telephone is defined %}
                                                    <div class="invalid-feedback">{{ errors.telephone}}</div>
                                                {% endif %}
                                            </div>

                                            <div class="form-group">
                                                <label for="mail">E-mail <i class="ion ion-android-star"></i></label>
                                                <input type="input" class="form-control {% if errors.email is defined %}is-invalid{% endif %}" id="email" name="email" value="{{ tmpCompany.email}}" tabindex="6">
                                                {% if errors.email is defined %}
                                                    <div class="invalid-feedback">{{ errors.email }}</div>
                                                {% endif %}
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="vat-number">Btw-nummer</label>
                                                <input type="input" class="form-control {% if errors.vatNumber is defined %}is-invalid{% endif %}" id="vat-number" name="vat-number" value="{{ tmpCompany.vatNumber }}" tabindex="7">
                                                {% if errors.vatNumber is defined %}
                                                    <div class="invalid-feedback">{{ errors.vatNumber }}</div>
                                                {% endif %}
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary mt-2" tabindex="7">Wijzigen</button>
                                                <a href="companyProfile.php" class="btn btn-sm btn-outline-primary mt-2" tabindex="8">Annuleren</a>
                                            </div>

                                            <small><i>Velden met een <i class="ion ion-android-star"></i> zijn verplicht.</i></small>          
                                            
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