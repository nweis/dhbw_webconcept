<div id="wrapper">
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand"><?php echo __('Concept-Map').': '.$conceptMap['ConceptMap']['name'] ?></li>
            <?php foreach ($conceptMap['Keyword'] as $keyword): ?>
                <li class="keyword"><?php echo $keyword['name'] ?></li>    
            <?php endforeach ?>
        </ul>
    </div>
    <div id="page-content-wrapper">
       <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1>JsPlumb-View</h1>
                    <?php debug($conceptMap);?>
                    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>