<template>
    <div class="text-white mb-5">
        <div class="forecast rounded">
            <div class="d-flex align-content-center justify-content-between px-3 py-4">
                <div class="d-flex align-items-center">
                    <div>
                        <div class="forecast__current font-weight-bold">42°F</div>
                        <div class="">Feels like 40°F</div>
                    </div>
                    <div class="mx-3">
                        <div class="font-weight-bold">Cloudy</div>
                        <div>Allentown, PA</div>
                    </div>
                </div>
                <div>Icon</div>
            </div>
        </div>
        <div class="forecast__future-weather px-3 py-4 overflow-hidden">
            <div class="d-flex align-items-center">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 forecast__day">MON</div>
                        <div class="col-6 px-2 d-flex align-items-center ">
                            <div>Icon</div>
                            <div class="ml-1">Cloudy with a chance of showers</div>
                        </div>
                        <div class="col-3 text-right mt-2">
                            <div>50°F</div>
                            <div>35°F</div>
                        </div>

                        <div class="col-3 forecast__day mt-2">TUES</div>
                        <div class="col-6 px-2 d-flex align-items-center ">
                            <div>Icon</div>
                            <div class="ml-1">Cloudy with a chance of showers</div>
                        </div>
                        <div class="col-3 text-right mt-2">
                            <div>50°F</div>
                            <div>35°F</div>
                        </div>

                        <div class="col-3 forecast__day mt-2">WED</div>
                        <div class="col-6 px-2 d-flex align-items-center ">
                            <div>Icon</div>
                            <div class="ml-1">Cloudy with a chance of showers</div>
                        </div>
                        <div class="col-3 text-right mt-2">
                            <div>50°F</div>
                            <div>35°F</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "Forecast"
}
</script>

<style scoped>

</style>
