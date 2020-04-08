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
                <h2 class="keywords-section-title">Keywords</h2>
                <div class="keyword-controls">
                    <button id="btn-add-keyword" class="button is-small keyword-control">Add Keyword</button>
                    <button id="btn-del-keywords" class="button is-small keyword-control">Delete Keyword(s)</button>
                </div>
                <ul id="keywords-list">

                </ul>
            </section>
        </main>

    </div>

    @include('footer')

    @include('loading')
</body>

</html>