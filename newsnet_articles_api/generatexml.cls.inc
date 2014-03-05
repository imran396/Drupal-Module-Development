<?php

class generateXml{

    private $articlesNids;

    public function __construct(array $artcleNodes){
        $this->articlesNids =  $artcleNodes;
    }

    public function xmlOutPut($version = null){
        switch($version){
            case 'v1' :
                return $this->generatexmlV1();
            break;

        }

    }

    public function generatexmlV1(){


    $xmlDoc = new DOMDocument(1.0,'UTF-8');
    //create the root element
	$root = $xmlDoc->createElement("articles");
    $xmlDoc->appendChild($root);

      foreach ($this->articlesNids as $node) {

        $node = node_load($node->nid);
		$article = $xmlDoc->createElement("article");

        $element = $xmlDoc->createElement("title");
		$title = $xmlDoc->createTextNode($node->title);
		$element->appendChild($title);
		$article->appendChild($element);

        $element = $xmlDoc->createElement("byline");

        $byline = '';
        if (isset($node->field_article_byline[0]['value'])) {
			$byline = $node->field_article_byline[0]['value'];
		}
		$byline = $xmlDoc->createTextNode($byline);
	    $element->appendChild($byline);
		$article->appendChild($element);

        $element = $xmlDoc->createElement("publish");

        $publish = '';

		if (isset($node->field_publish_date[0]['value'])) {
			$publish = $node->field_publish_date[0]['value'];
		}
		$publish = $xmlDoc->createTextNode($publish);
		$element->appendChild($publish);
		$article->appendChild($element);


		$element = $xmlDoc->createElement("body");
		$body = $xmlDoc->createTextNode($node->body);
	    $element->appendChild($body);
		$article->appendChild($element);

        $body_element = $xmlDoc->createElement("images");

		if (!empty($node->field_images[0])) {

            foreach ($node->field_images as $field) {
				$image = $xmlDoc->createElement("image");
				$element = $xmlDoc->createElement("url");
				$fullpath = $xmlDoc->createTextNode(file_create_url($field['filepath']));
			    $element->appendChild($fullpath);
				$image->appendChild($element);

				$element = $xmlDoc->createElement("caption");

                $caption_body = '';

                if (isset($field['data']['article_photo_caption']['body'])) {
					$caption_body = $field['data']['article_photo_caption']['body'];
				}

				$caption = $xmlDoc->createTextNode($caption_body);
				$element->appendChild($caption);
				$image->appendChild($element);

				$element = $xmlDoc->createElement("credit");

               $photocredit = '';

                if (isset($field['data']['article_photo_credit']['body'])) {
					$photocredit = $field['data']['article_photo_credit']['body'];
				}

                $photocredit = $xmlDoc->createTextNode($photocredit);

                $element->appendChild($photocredit);
				$image->appendChild($element);
				$body_element->appendChild($image);
			}

		}else{
            $empty_image = $xmlDoc->createTextNode('');
            $body_element->appendChild($empty_image );
        }


        $article->appendChild($body_element);
        $root->appendChild($article);

     }

    //make the output pretty
    $xmlDoc->formatOutput = true;
    return $xmlDoc->saveXML();

  }

}