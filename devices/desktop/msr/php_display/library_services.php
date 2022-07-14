<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 homeFeed">
        <div class="feature-title"><?php echo $trans->getText("Library Services");?></div>
            <div class="feature-title-line"></div>
            <!-- Library Services - Items from AJAX -->
            <div class="services-feed" id="servicesFeed" pageid="<?php echo $wmPage["Parent"];?>"></div>
        </div>
        <!-- SIDE CONTENT -->
        <div class="col-10 offset-1 col-sm-10 offset-sm-1 col-md-4 offset-md-0 col-lg-4 offset-lg-0 pageSideContent">
            <!-- Updates Feed Title -->
            <div class="feature-title"><?php echo $trans->getText("Updates");?></div>
            <div class="feature-title-line"></div>

            <!-- Updates Feed - Items from AJAX -->
            <div class="updates-feed" id="updatesFeed" pageid="<?php echo $wmPage["Parent"];?>"></div>

            <button class="btn-load-more" id="loadMoreUpdatesBtn" onclick="loadMoreUpdates(10);"><?php echo $trans->getText("Load More");?></button>
        </div>
    </div>
</div>