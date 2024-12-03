<section class="section-2 bg-2 py-5">
    <div class="container">
        <h2>Popular Categories</h2>
        <div class="row pt-5">
            @foreach ($categories as $category)
                <div class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_catagory">
                        <a href="{{ route('jobs.index', ['category' => $category->id]) }}">
                            <h4 class="pb-2">{{ $category->name }}</h4>
                        </a>
                        <p class="mb-0"> <span>0</span> Available positions</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
