<template>
    <GeneralLayout>
        <div class="flex flex-col justify-center">
            <h1 class="text-center" >
                ¡Mucha suerte en tu prueba técnica!
            </h1>
            <h2 class="mb-3 text-center">
                Te dejamos una canción para que te puedas concentrar más facilmente :)
            </h2>
            <iframe allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" allowfullscreen=""
                    frameBorder="0" height="380"
                    src="https://open.spotify.com/embed/track/2ro0qOXYR1Zf7UD4BqGFqj?utm_source=generator"
                    width="100%"></iframe>
        </div>
    </GeneralLayout>
</template>

<script>
import GeneralLayout from "@/Layouts/GeneralLayout";

export default {
    components: {
        GeneralLayout,
    },
}
</script>
