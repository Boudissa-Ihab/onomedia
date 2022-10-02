<div>
    <main id="main">
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Portfolio Details</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Accueil</a></li>
                        <li>Détails Portfolio</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Portfolio Details Section ======= -->
        <section id="portfolio-details" class="portfolio-details">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-8">
                        @if($project->images->count() > 0)
                            <div class="portfolio-details-slider swiper">
                                <div class="swiper-wrapper align-items-center">
                                    @foreach($project->images as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ asset('storage/projects/' . $project->name . '/' . $image->url) }}" alt="{{ $project->name }}">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        <div class="portfolio-info">
                            <h3>Informations sur le projet</h3>
                            <ul>
                                <li><strong>Catégorie(s)</strong>:
                                    @foreach ($project->categories as $category)
                                        @if ($loop->last)
                                            {{ $category->name }}
                                        @else
                                            {{ $category->name }} -
                                        @endif
                                    @endforeach
                                </li>
                                <li><strong>Client</strong>: {{ $project->client }}</li>
                                <li><strong>Date de finition</strong>: {{ date("d-m-Y", strtotime($project->date)) }}</li>
                                @if($project->url)
                                    <li><strong>URL du projet</strong>: <a href="#">{{ $project->url }}</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="portfolio-description">
                            <h2>Description</h2>
                            <p>
                                {{ $project->description}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Portfolio Details Section -->
    </main>
</div>
