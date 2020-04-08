<!DOCTYPE html>
<html lang="en">

@include('head')

<body>

    @include('header')

    @if (Auth::check())
    @include('nav')
    @endif

    <div class="container">

        <p class="no-results">You have not added any keywords.</p>

        <main class="criteria">
            <section class="keywords-section">
                <div class="keyword-controls">
                    <h2 class="keywords-section-title">Keywords</h2>
                    <button id="btn-add-keyword" class="keyword-control">Add +</button>
                    <button id="btn-del-keywords" class="keyword-control">Remove -</button>
                </div>
                <small><em>Stories that contain these keywords in the title will be curated.</em></small>
                <ul id="keywords-list">

                </ul>
            </section>
        </main>

    </div>

    @include('footer')

    @include('loading')
</body>

</html>