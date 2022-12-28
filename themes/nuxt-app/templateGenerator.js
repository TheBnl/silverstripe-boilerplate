//read build files
console.log("Generating SS template...");
let fs = require('fs');
let assetFiles = fs.readdirSync('./dist/spa/assets');

//Get the relevant files for the SS template
let appFile = "";
let cssFile = "";
assetFiles.forEach((file) => {
    if( file.split('.')[2] === 'js' && file.split('.')[0] === 'index' ){
      appFile = file;
    } else if( file.split('.')[2] === 'css' && file.split('.')[0] === 'index' ){
      cssFile = file;
    }
})

console.log("Found the following files:")
console.log(assetFiles);
console.log("APP:")
console.log(appFile);
console.log("CSS:")
console.log(cssFile);

//ss template structure
let data = '<!DOCTYPE html>' +
    '<html>' +
    '<head>' +
    // '<base href="themes/vue-app/dist/spa/assets/"></base>' +
    '<script type="module" crossorigin src="themes/vue-app/dist/spa/assets/' + appFile + '"></script>' +
    '<link rel="stylesheet" href="themes/vue-app/dist/spa/assets/' + cssFile + '">' +
    '</head>' +
    '<body>' +
    '<div id="q-app"></div>' +
    '</body>' +
    '</html>';

//write SS template file
console.log("Writing the SS template file...")
fs.writeFile('./templates/Page.ss', data, (e) => {
    if(e){
        console.log("Writing failed")
        console.log(e)
    }else{
        console.log("Success!")
    }
})

