/*
 Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
*/
function ChangeToSlug(title) {
    title = title.replace(/^\s+|\s+$/g, '')
        .toLowerCase()
        .replace(/[áàảạãăắằẳẵặâấầẩẫậ]/gi, 'a')
        .replace(/[éèẻẽẹêếềểễệ]/gi, 'e')
        .replace(/[iíìỉĩị]/gi, 'i')
        .replace(/[óòỏõọôốồổỗộơớờởỡợ]/gi, 'o')
        .replace(/[úùủũụưứừửữự]/gi, 'u')
        .replace(/[ýỳỷỹỵ]/gi, 'y')
        .replace(/đ/gi, 'd')
        .replace(/[`~!@#|$%^&*()+=,.\/?><'":;_]/gi, '')
        .replace(/&/g, '-va-')
        .replace(/[^\w\-]+/g, '-')
        .replace(/\s+/g, '-')
        .replace(/\-\-+/g, '-')
        .replace(/^-+/, '')
        .replace(/-+$/, '');
    return title
}

CKEDITOR.dialog.add("anchor",function(c){function d(b,a){return b.createFakeElement(b.document.createElement("a",{attributes:a}),"cke_anchor","anchor")}return{title:c.lang.link.anchor.title,minWidth:300,minHeight:60,getModel:function(b){var a=b.getSelection();b=a.getRanges()[0];a=a.getSelectedElement();b.shrink(CKEDITOR.SHRINK_ELEMENT);(a=b.getEnclosedNode())&&a.type===CKEDITOR.NODE_TEXT&&(a=a.getParent());b=a&&a.type===CKEDITOR.NODE_ELEMENT&&("anchor"===a.data("cke-real-element-type")||a.is("a"))?
a:void 0;return b||null},onOk:function(){var b=CKEDITOR.tools.trim(ChangeToSlug(this.getValueOf("info","txtName"))),b={name:b,"data-cke-saved-name":b},a=this.getModel(c);a?a.data("cke-realelement")?(b=d(c,b),b.replace(a),CKEDITOR.env.ie&&c.getSelection().selectElement(b)):a.setAttributes(b):(a=(a=c.getSelection())&&a.getRanges()[0],a.collapsed?(b=d(c,b),a.insertNode(b)):(CKEDITOR.env.ie&&9>CKEDITOR.env.version&&(b["class"]="cke_anchor"),b=new CKEDITOR.style({element:"a",attributes:b}),b.type=CKEDITOR.STYLE_INLINE,
b.applyToRange(a)))},onShow:function(){var b=c.getSelection(),a=this.getModel(c),d=a&&a.data("cke-realelement");if(a=d?CKEDITOR.plugins.link.tryRestoreFakeAnchor(c,a):CKEDITOR.plugins.link.getSelectedLink(c)){var e=a.data("cke-saved-name");this.setValueOf("info","txtName",e||"");!d&&b.selectElement(a)}this.getContentElement("info","txtName").focus()},contents:[{id:"info",label:c.lang.link.anchor.title,accessKey:"I",elements:[{type:"text",id:"txtName",label:c.lang.link.anchor.name,required:!0,validate:function(){return this.getValue()?
!0:(alert(c.lang.link.anchor.errorName),!1)}}]}]}});
