<template>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <router-link to="/" class="navbar-brand">Track yoself</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">Go to homas</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/track" class="nav-link">Track</router-link>
                    </li>
                </ul>
            </div>
        </nav>

        <main>
            <div class="container">
                <router-view/>
            </div>
        </main>

    </div>
</template>


<style>

main {
    padding: 100px 0;
}

</style>
