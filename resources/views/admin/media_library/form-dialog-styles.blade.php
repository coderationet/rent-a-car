<style>
    .gc-image-library-field{
        width: 100%;
    }
    .gc-library-preview-container img{
        max-width: 100%;
        max-height: 100%;
    }
    .gc-library-preview-container .placeholder-name{
        position: absolute;
        top: calc(50% - 10px);
        color: #ddd;
    }
    .gc-library-preview-container .cursor-pointer{
        cursor: pointer;
    }
    .gc-library-preview-container video{
        height: 100%;

    }
    .gc-library-preview-container{
        width: 100%;
        min-height: 250px;
        border: 1px solid #ddd;
        display: flex;
        justify-content: center;
        align-items: center;
        position:relative;
    }
    .gc-library-preview-container.multiple-image.has-image{
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        padding: 10px;
    }
    .gc-library-preview-container.multiple-image.has-image .image-item{
        border: 2px solid #ddd;
        position: relative;
        height: auto;
        min-height: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .gc-library-preview-container.multiple-image.has-image .image-item .remove-item{
        position: absolute;
        top: -10px;
        right: -10px;
        background: #fff;
        border-radius: 50%;
        padding: 5px;
        border: 1px solid #ddd;
        color: #000;
        cursor: pointer;
    }
</style>
