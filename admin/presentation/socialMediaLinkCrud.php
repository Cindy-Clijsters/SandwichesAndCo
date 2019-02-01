<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Beheer {{ companyName }} :: {{ title }}</title>
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
                                        <h4>{{ title }}</h4>
                                    </div>
                                    <div class="card-body">
                                       
                                        <form action="" method="post" novalidate>
                                            
                                            <div class="form-group">
                                                <label for="identifier">Sociale media <i class="ion ion-android-star"></i></label>
                                                <select class="form-control {% if errors.identifier is defined %}is-invalid{% endif %}" id="identifier" name="identifier" tabindex="1" autofocus>
                                                    <option value=""></option>
                                                    {% for identifierOption in socialMediaLinkIdentifiers %}
                                                        <option value="{{ identifierOption }}" {% if (tmpLink.identifier == identifierOption) %} selected {% endif %}>{{ translateSocialMediaLinkIdentifier(identifierOption) }}</option>
                                                    {% endfor %}
                                                </select>
                                                {% if errors.identifier is defined %}
                                                    <div class="invalid-feedback">{{ errors.identifier }}</div>
                                                {% endif %}
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="url">Url <i class="ion ion-android-star"></i></label>
                                                <input type="input" class="form-control {% if errors.url is defined %}is-invalid{% endif %}" id="url" name="url" value="{{ tmpLink.url }}" tabindex="2">
                                                {% if errors.url is defined %}
                                                    <div class="invalid-feedback">{{ errors.url }}</div>
                                                {% endif %}
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="status">Status <i class="ion ion-android-star"></i></label>
                                                <select class="form-control {% if errors.status is defined %}is-invalid{% endif %}" id="status" name="status" tabindex="3">
                                                    <option value=""></option>
                                                    {% for statusOption in socialMediaLinkStatuses %}
                                                        <option value="{{ statusOption }}" {% if (tmpLink.status == statusOption) %} selected {% endif %}>{{ translateSocialMediaLinkStatus(statusOption)}}</option>
                                                    {% endfor %}
                                                </select>
                                                {% if errors.status is defined %}
                                                    <div class="invalid-feedback">{{ errors.status }}</div>
                                                {% endif %}
                                            </div>
                                            
                                            <div class="form-group">
                                                <button ctype="submit" class="btn btn-sm btn-primary mt-2" tabindex="4">{{ buttonText}}</button>
                                                <a href="companyProfile.php" class="btn btn-sm btn-outline-primary mt-2" tabindex="5">Annuleren</a>
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