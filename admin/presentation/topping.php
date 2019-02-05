<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Beheer {{ companyName }} :: Toppings</title>
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
                        <div>Toppings</div>
                    </h1>
                    
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Toppings</h4>
                                    </div>
                                    <div class="card-body">
                                        {% if toppingMsg is not empty %}
                                            <div class="alert alert-{{ toppingMsgType }}">
                                                {{ toppingMsg }}
                                            </div>
                                        {% endif %}
                                        
                                        {% if toppings is empty %}
                                        
                                            <p>Er zijn nog geen toppings toegevoegd.</p>
                                        
                                        {% else %}
                                        
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Topping</th>
                                                            <th>Status</th>
                                                            <th>Opties</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {% for topping in toppings %}
                                                            <tr>
                                                                <td>{{ topping.name }}</td>
                                                                <td>
                                                                    <div class="badge {% if topping.status == 'active' %} badge-success {% else %} badge-danger {% endif %} ">
                                                                        {{ translateToppingStatus(topping.status) }}
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="toppingUpdate.php?id={{ topping.id }}" class="btn btn-action btn-secondary">Wijzigen</i></a>
                                                                    <a href="toppingDelete.php?id={{ topping.id }}" class="btn btn-action btn-secondary">Verwijderen</i></a>
                                                                </td>
                                                            </tr>
                                                        {% endfor %}
                                                    </tbody>
                                                </table>
                                            </div>
                                        
                                        {% endif %}
                                        
                                        <a href="toppingCreate.php" class="btn btn-action btn-primary mt-2" tabindex="1">Een nieuwe topping toevoegen</i></a>
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