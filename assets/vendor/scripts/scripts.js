var cropper = new Slim(document.getElementById('myCropper'), {
	ratio: '3:4',
	minSize: {
		width: 250,
		height: 300,
	},
	size: {
		width: 250,
		height: 300,
	},
	download: true,
	instantEdit: true,
	label: 'Upload: Click here or drag an image file onto it',
	buttonConfirmLabel: 'Finished',
	buttonConfirmTitle: 'Finished',
	buttonCancelLabel: 'Breaking off',
	buttonCancelTitle: 'Breaking off',
	buttonEditTitle: 'To edit',
	buttonRemoveTitle: 'Remove',
	buttonDownloadTitle: 'Download',
	buttonRotateTitle: 'Rotate',
	buttonUploadTitle: 'Upload',
	statusImageTooSmall:'This picture is too small. The minimum size is $ 0 pixels.'
});