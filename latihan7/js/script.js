function searchMovie() {
    // Setiap pertama kali diklik hilangkan terlebih dahulu movie list nya dan HTML nya di kosongkan
    $('#movie-list').html('');


    // Merequest data dari omdbapi
    $.ajax({
        url: 'http://www.omdbapi.com',
        type: 'get',
        dataType: 'json',
        data: {
            'apikey': '6a9aee1a',
            's': $('#search-input').val()

        },
        success: function(result) {
            if(result.Response == "True") {

                let movies = result.Search;
                console.log(movies);

                $.each(movies, function(i, data) {
                    $('#movie-list').append(`
                        <div class="col-md-4">
                            <div class="card mb-3" style="width: 18rem;">
                            <img src="`+ data.Poster +`" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">`+ data.Title +`</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">`+ data.Year +`</h6>
                                    <a href="#" class="card-link see-detail" data-toggle="modal" data-target="#exampleModal" data-id="`+ data.imdbID +`">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    `);
                });

                $('#search-input').val('');

            } else {
                $('#movie-list').html(`
                                        <div class="col">
                                            <h1 class="text-center">`+ result.Error +`</h1>
                                        </div>
                                    `);
            }
        }
    });
}

$('#search-button').on('click', function() {
    searchMovie();
});

$('#search-input').on('keyup', function(e) {
    if(e.which == 13) {
        searchMovie();
    }
});

$('#movie-list').on('click', '.see-detail', function() {
    $.ajax({
        url: 'http://www.omdbapi.com',
        dataType: 'json',
        type: 'get',
        data: {
            'apikey' : '6a9aee1a',
            'i' : $(this).data('id')
        },
        success: function(movie) {
            if(movie.Response === "True") {
                $('.modal-body').html(`

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="`+ movie.Poster +`" class="img-fluid">
                            </div>

                            <div class="col-md-8">
                                <ul class="list-group">
                                    <li class="list-group-item"><h3>`+ movie.Title +`</h3></li>
                                    <li class="list-group-item"><b>Description : </b>`+ movie.Plot +`</li>
                                    <li class="list-group-item"><b>Ratings : </b><i class="fa fa-star checked"></i> `+ movie.imdbRating +`</li>
                                    <li class="list-group-item"><b>Released : </b>`+ movie.Released +`</li>
                                    <li class="list-group-item"><b>Genre : </b>`+ movie.Genre +`</li>
                                    <li class="list-group-item"><b>Director : </b>`+ movie.Director +`</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                `);
            }
        }
    });
});