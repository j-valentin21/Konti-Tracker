<template>
    <div class="weather">
        <div class="weather__container">
            <header class="weather__header">
                <input type="text" autocomplete="off" class="weather__header-text" placeholder="Search for a city..." />
            </header>
            <main class="weather__body">
                <section>
                    <div class="weather__city">Orefield, PA</div>
                    <div class="weather__date">Thursday 10 January 2020</div>
                </section>
                <div>
                    <div class="weather__temp">15<span class="weather__celsius">°F</span></div>
                    <div class="weather__name">Sunny</div>
                    <div class="weather__hi-lo">13°F / 16°F</div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
export default {
    name: "Weather"
}
</script>

<style scoped>

</style>
