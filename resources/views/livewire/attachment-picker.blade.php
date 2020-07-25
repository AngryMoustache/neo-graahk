<div class="attachment-picker">
    <div class="attachment-picker-buttons">
        <a class="button" wire:click.prevent="openSelectingModal">Select image</a>
        <a class="button" wire:click.prevent="openUploadingModal">Upload image</a>
    </div>

    <div class="attachment-picker-preview">
        @if ($item)
            <img src="{{ $item }}">
            <h3 wire:click="resetImage">
                <i class="fas fa-times"></i> Remove
            </h3>
        @else
            <p>No attachment selected</p>
        @endif

        <input
            type="hidden"
            wire:model="picked"
            name="{{ $fieldName }}"
        >
    </div>

    @if ($selecting)
        <div class="attachment-picker-selecting-modal modal">
            <div class="modal-container">
                <div class="modal-container-header">
                    <h2>Select an attachment</h2>
                    <a wire:click.prevent="closeModal">
                        <i class="fas fa-times"></i>
                    </a>
                </div>

                <div class="modal-container-body">
                    <div class="modal-attachments-list">
                        @foreach ($attachments as $attachment)
                            <div
                                class="modal-attachments-list-item"
                                wire:click="chooseAttachment({{ $attachment->id }})"
                            >
                                <img src="{{ $attachment->format('thumb') }}">
                                <span>{{ $attachment->original_name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($uploading)
        <div class="attachment-picker-uploading-modal modal">
            <div class="modal-container">
                <div class="modal-container-header">
                    <h2>Upload an attachment</h2>
                    <a wire:click.prevent="closeModal">
                        <i class="fas fa-times"></i>
                    </a>
                </div>

                <div class="modal-container-body">
                    <div class="attachment-picker-dropzone">
                        <input id="{{ $fieldName }}_upload" type="file" wire:model="upload">

                        <div class="attachment-picker-dropzone-dropper">
                            <div class="attachment-picker-dropzone-dropper-text">
                                @if ($upload)
                                    <h3>{{ $upload->getClientOriginalName() }}</h3>
                                @else
                                    <h3><i class="fas fa-plus"></i> Click to upload</h3>
                                @endif
                            </div>
                        </div>

                        @if ($upload)
                            <div
                                class="attachment-picker-dropzone-preview"
                                style="background-image: url({{ $upload->temporaryUrl() }})"
                            ></div>
                        @endif
                    </div>
                </div>

                @if ($upload)
                    <div class="modal-container-footer">
                        <a class="button" wire:click.prevent="uploadFile">
                            Upload
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
