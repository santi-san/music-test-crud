<?php
include 'header.php';
?>
    <!-- TOP MV -->
    <section class="my-5">
        <h4 class="text-muted mb-4">TOP MV</h4>
        <div class="row">

            <div class="col-12 col-sm-4 col-md-3 pb-3">
                <div class="card bg-yellow text-dark">
                    <img src="img/1.jpg" class="card-img-top" alt="...">
                    <div class="data-mv">
                        <H6 class="font-weight-bold">Song name</H6>
                        <p class="card-text"><small><a href="#" class="text-dark">Artist name</a></small></p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-4 col-md-3 pb-3">
                <div class="card bg-yellow text-dark">
                    <img src="img/1.jpg" class="card-img-top" alt="...">
                    <div class="data-mv">
                        <H6 class="font-weight-bold">Song name</H6>
                        <p class="card-text"><small><a href="#" class="text-dark">Artist name</a></small></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-3 pb-3">
                <div class="card bg-yellow text-dark">
                    <img src="img/1.jpg" class="card-img-top" alt="...">
                    <div class="data-mv">
                        <H6 class="font-weight-bold">Song name</H6>
                        <p class="card-text"><small><a href="#" class="text-dark">Artist name</a></small></p>
                    </div>
                </div>
            </div>
            <div class="d-none d-sm-none d-md-block col-md-3">
                <div class="card bg-yellow text-dark">
                    <img src="img/1.jpg" class="card-img-top" alt="...">
                    <div class="data-mv">
                        <H6 class="font-weight-bold">Song name</H6>
                        <p class="card-text"><small><a href="#" class="text-dark">Artist name</a></small></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Releases -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-8">
        <section class="my-5">
            <div class="card bg-white p-5">
                <div class="d-flex justify-content-between">
                <h4 class="text-muted mb-4">NEW RELEASES</h4>
                    <a href="#"><h5 class="text-muted mb-4">See All</h5></a>
                </div>
                <div class="row g-4">
                    <?php
                        require 'latest_releases.php';
                    ?>
                </div>
            </div>
        </section>
    </div>
    <!-- Playlist recommendations -->
    <section class="my-5">

        <h4 class="text-muted mb-4">RECOMMENDED PLAYLIST</h4>

        <div id="playlist" class="row">
            <div class="col-5 col-sm-6 col-md-2">
                <div class="text-muted">
                    <img class="mr-2 rounded pb-2" src="img/Recommendedday.png" alt="recommendations">
                    <p>Daily recommendations</p>
                </div>
            </div>
            <div class="col-5 col-sm-6 col-md-2">
                <div class="text-muted">
                    <img class="mr-2 rounded pb-2" src="img/Recommended1.png" alt="recommendations">
                    <p>Chinese Rap</p>
                </div>
            </div>
            <div class="col-5 col-sm-6 col-md-2">
                <div class="text-muted">
                    <img class="mr-2 rounded pb-2" src="img/Recommended2.png" alt="recommendations">
                    <p>Dubstep</p>
                </div>
            </div>
            <div class="col-5 col-sm-6 col-md-2">
                <div class="text-muted">
                    <img class="mr-2 rounded pb-2" src="img/Recommended3.png" alt="recommendations">
                    <p>Future Bass</p>
                </div>
            </div>
            <div class="col-5 col-sm-6 col-md-2">
                <div class="text-muted">
                    <img class="mr-2 rounded pb-2" src="img/Recommended4.png" alt="recommendations">
                    <p>House</p>
                </div>
            </div>
            <div class="col-5 col-sm-6 col-md-2">
                <div class="text-muted">
                    <img class="mr-2 rounded pb-2" src="img/Recommendedday.png" alt="recommendations">
                    <p>Daily song recommendations</p>
                </div>
            </div>
            <div class="col-5 col-sm-6 col-md-2">
                <div class="text-muted">
                    <img class="mr-2 rounded pb-2" src="img/Recommended1.png" alt="recommendations">
                    <p>Chinese Rap</p>
                </div>
            </div>
            <div class="col-5 col-sm-6 col-md-2">
                <div class="text-muted">
                    <img class="mr-2 rounded pb-2" src="img/Recommended2.png" alt="recommendations">
                    <p>Dubstep</p>
                </div>
            </div>
            <div class="col-5 col-sm-6 col-md-2">
                <div class="text-muted">
                    <img class="mr-2 rounded pb-2" src="img/Recommended3.png" alt="recommendations">
                    <p>Future Bass</p>
                </div>
            </div>
            <div class="col-5 col-sm-6 col-md-2">
                <div class="text-muted">
                    <img class="mr-2 rounded pb-2" src="img/Recommended4.png" alt="recommendations">
                    <p>House</p>
                </div>
            </div>
        </div>
    </section>

<?php
include 'footer.php';
