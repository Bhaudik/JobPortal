@section('fillter')
    <script>
       
        $(document).ready(function() {
            // Trigger AJAX request when any filter is changed
            $('#sort, #category, #job_type, #experience').on('change', function() {
                // Get filter values
                var keywords = $('#keywords').val();
                var location = $('#location').val();
                var category = $('#category').val();
                var job_type = [];
                $('input[name="job_type"]:checked').each(function() {
                    job_type.push($(this).val());
                });
                var experience = $('#experience').val();

                // Make the AJAX request
                $.ajax({
                    url: '{{ route('jobs.filter') }}',
                    method: 'GET',
                    data: {
                        keywords: keywords,
                        location: location,
                        category: category,
                        job_type: job_type,
                        experience: experience
                    },
                    success: function(response) {
                        // Clear previous job listings
                        $('.job_listing_area').empty();

                        // Add new job listings from the response
                        $.each(response.jobs, function(index, job) {
                            var jobCard = `
                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">${job.title}</h3>
                                    <p>${job.description}</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">${job.location}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                            <span class="ps-1">${job.jobType.name}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                            <span class="ps-1">${job.salary}</span>
                                        </p>
                                    </div>
                                    <div class="d-grid mt-3">
                                        <a href="job-detail.html" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                            $('.job_listing_area').append(jobCard);
                        });
                    }
                });
            });
        });
    </script>
@endsection
