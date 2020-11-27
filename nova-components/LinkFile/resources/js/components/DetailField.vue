<template>
    <div class="">
        <div class="text-center w-full align-end">
            <a   :href="`/storage/${field.value}`" target="_blank" class="mt-4 cursor-pointer dim btn btn-link text-primary inline-flex items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" aria-labelledby="download" role="presentation" class="fill-current mr-2"><path d="M11 14.59V3a1 1 0 0 1 2 0v11.59l3.3-3.3a1 1 0 0 1 1.4 1.42l-5 5a1 1 0 0 1-1.4 0l-5-5a1 1 0 0 1 1.4-1.42l3.3 3.3zM3 17a1 1 0 0 1 2 0v3h14v-3a1 1 0 0 1 2 0v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3z"></path></svg> <span class="class mt-1">Descargar</span></a>
        </div>
    </div>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
}
</script>
