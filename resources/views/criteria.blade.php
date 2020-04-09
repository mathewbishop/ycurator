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
                    <input type="text" id="keyword-input" class="input is-small is-rounded"
                        placeholder="Type keyword..">
                    <button id="btn-add-keyword" class="button is-small is-success is-rounded">Add Keyword</button>
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