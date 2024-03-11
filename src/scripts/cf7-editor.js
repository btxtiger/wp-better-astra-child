document.addEventListener('DOMContentLoaded', () => {
   setTimeout(() => {
      document.querySelectorAll('.cf7mls-app-step-content textarea').forEach((textArea) => {
         textArea.style.display = 'none';

         const editorDiv = document.createElement('div');
         editorDiv.style.height = '70vh';
         textArea.parentNode.insertBefore(editorDiv, textArea.nextSibling);

         const options = { indent_size: 3, space_in_empty_paren: false };
         const editor = ace.edit(editorDiv);
         editor.setTheme('ace/theme/one_dark');
         editor.getSession().setMode('ace/mode/html');
         editor.setValue(html_beautify(textArea.value, options), -1);
         editor.setFontSize('14px');
         editor.setPrintMarginColumn(130);
         editor.setOptions({
            enableBasicAutocompletion: true,
            enableSnippets: true,
            enableLiveAutocompletion: true,
            enableEmmet: true,
            tabSize: 3,
            useSoftTabs: true,
            navigateWithinSoftTabs: true,
            showGutter: true,
            vScrollBarAlwaysVisible: false,
         });

         editor.getSession().on('change', () => {
            textArea.value = editor.getSession().getValue();
            textArea.dispatchEvent(new Event('input', { bubbles: true }));
         });
      });

      document.querySelectorAll('.cf7mls-app-step-content .ace_print-margin').forEach((line) => {
         line.style.background = '#444';
      });
   }, 250);
});
