import fs from 'fs';

console.log('Generating SS template...');

const buildEntryFile = './build/index.html';
const templateFile = './templates/Page.ss';
const fromAppFolder = '/_app';
const toAppFolder = '$ThemeDir/build/_app';

console.log('Reading contents of:', buildEntryFile);
fs.readFile(buildEntryFile, 'utf-8', (err, file) => {
    if (err) {
        console.error('error while reading file:', buildEntryFile, 'err:', err);
        return;
    }

    // console.log('Change all /_app to $ThemeDir/build/_app');
    // const replaced = file.replaceAll(fromAppFolder, toAppFolder);
    const replaced = file;

    console.log('Write to:', templateFile);
    fs.writeFile(templateFile, replaced, 'utf-8', function (err) {
        if (err) {
            console.error('error while writing file:', templateFile, 'err:', err);
        }
    });
});
