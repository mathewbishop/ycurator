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
                <ul id="keywords-list">

                </ul>
                <div>
                    <button>Cancel</button>
                    <button>Confirm</button>
                    <p>Type in a keyword and hit enter (or click the <strong>Add</strong> button below). When you're
                        done, click the <strong>Confirm</strong> button at the top to add the keywords.</p>
                    <input type="text" id="keyword-input">
                    <ul id="temporary-keywords">

                    </ul>
                </div>
            </section>
        </main>

    </div>

    @include('footer')

    @include('loading')
</body>

</html>