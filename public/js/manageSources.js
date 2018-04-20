'use strict';


function createMinusFieldset(){
  let minusFieldset = document.createElement('fieldset');
  minusFieldset.setAttribute('class','form-group');
  minusFieldset.setAttribute('onclick','removeSource(this)');
  let minusIcon = document.createElement('i');
  minusIcon.setAttribute('class','fas fa-minus-circle');
  minusFieldset.appendChild(minusIcon);
  return minusFieldset;
}

function createPlusFieldset(){
    let plusFieldset = document.createElement('fieldset');
    plusFieldset.setAttribute('class','form-group mr-3');
    plusFieldset.setAttribute('onclick','addSource(this)');
    let plusIcon = document.createElement('i');
    plusIcon.setAttribute('class','fas fa-plus-circle');
    plusFieldset.appendChild(plusIcon);
    return plusFieldset;
}

function displayErrors(errors,author,date,link){
    console.log(errors);
    const errorColor = 'red';
    if (errors.author){
        author.style.borderColor = errorColor;
        author.setAttribute('placeholder',errors.author);
    }
    if (errors.date){
        date.style.borderColor = errorColor;
        date.setAttribute('placeholder',errors.date);
    }
    if (errors.link){
        link.style.borderColor = errorColor;
        link.setAttribute('placeholder',errors.link);
    }
}

function validateInput(author,date,link){
    let errors = {};
    let authorValue = author.value;
    let dateValue = date.value;
    let linkValue = link.value;
    let urlRegex = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/;
    errors.hasErrors = false;
    if (authorValue != ""){
        if (!/^[0-9A-Za-z\s]+$/.test(authorValue)){
            errors.author = 'Insert a valid name';
            errors.hasErrors = true;
        }
    }
    if (dateValue != ""){
        if (!/^[1-2][0-9]{3}/.test(dateValue)){
            errors.date = 'Year should be a 4 digit number';
            errors.hasErrors = true;
        }
    }
    if (linkValue.length == 0){
        errors.link = 'Link should not be empty';
        errors.hasErrors = true;
    } else if (!urlRegex.test(linkValue)){
        errors.link = 'Not a valid URL';
        errors.hasErrors = true;
    }
    return errors;
}

function getInputFieldset(name,placeholder,required){
    let fieldset = document.createElement('fieldset');
    fieldset.setAttribute('class','form-group mr-3');
    let input = document.createElement('input');
    input.setAttribute('class','form-control')
    input.setAttribute('placeholder',placeholder);
    input.setAttribute('name',name+'[]');
    input.setAttribute('type','text');
    if (required){
        input.setAttribute('required','required');
    }
    fieldset.appendChild(input);
    return fieldset;
}

function getNewSourcesInput(){
    let externalDiv = document.createElement('div');
    externalDiv.setAttribute('class','d-flex flex-wrap align-items-center source-inputs');
    let authorFieldset = getInputFieldset('author','Publication author',false);
    let dateFieldset = getInputFieldset('date','Publication year',false);
    let linkFieldset = getInputFieldset('link','Link',true);
    let plusFieldset = createPlusFieldset();
    let minusFieldset = createMinusFieldset();
    externalDiv.append(authorFieldset,dateFieldset,linkFieldset,plusFieldset,minusFieldset);
    return externalDiv;
}


function addSource(e) {
    let sucessColor = 'green';
    let inputs = $('.source-inputs');
    let lastInput = inputs[inputs.length - 1];
    let author = lastInput.querySelector('input[name="author[]"]');
    let date = lastInput.querySelector('input[name="date[]"]');
    let link = lastInput.querySelector('input[name="link[]"]');
    let errors = validateInput(author,date,link);
    if (!errors.hasErrors){
        if (inputs.length == 1){
            inputs[0].appendChild(createMinusFieldset());
        }
        $('#editor-sources').append(getNewSourcesInput());
        if ( e.currentTarget != null){
            $(e.currentTarget).remove();
        }else{
            $(e).remove();
        }
        author.style.borderColor = sucessColor;
        date.style.borderColor = sucessColor;
        link.style.borderColor = sucessColor;
    }else{
        displayErrors(errors, author, date, link);
    }
}

function removeSource(clickedFieldset){
    
    let allSources = document.querySelector('#editor-sources');
    let lastSource = allSources.lastElementChild;
    if (lastSource.lastElementChild != clickedFieldset){
        if (allSources.childElementCount == 2){
            lastSource.lastElementChild.remove();
        }
    }else{
        if (allSources.childElementCount == 1){
            lastSource.lastElementChild.remove();
            lastSource.appendChild(createPlusFieldset());
        } else{
            lastSource.insertBefore(createPlusFieldset(),lastSource.children[3]);
        }
    }
    clickedFieldset.parentElement.remove();
    
    
    
    
    
}