<?php


class PreviewProvider{
    /**
     * @var PDO
     */
    private $con;
    private $username;

    public function __construct($con, $username){
        $this->con = $con;
        $this->username = $username;
    }

    /**
     * Funkcja tworząca zapowiedź w głównej zakłądce
     * @param $categoryId
     * @return string
     */
    public function createCategoryPreviewVideo($categoryId) {
        $entitiesArray = EntityProvider::getEntities($this->con, $categoryId, 1);

        if(sizeof($entitiesArray) == 0) {
            ErrorMessage::show("No TV shows to display");
        }

        return $this->createPreviewVideo($entitiesArray[0]);
    }

    /**
     * Funkcja tworząca zapowiedź w zakładce TV SHow
     * @return string
     */
    public function createTVShowPreviewVideo() {
        $entitiesArray = EntityProvider::getTVShowEntities($this->con, null, 1);

        if(sizeof($entitiesArray) == 0) {
            ErrorMessage::show("No TV shows to display");
        }

        return $this->createPreviewVideo($entitiesArray[0]);
    }

    /**
     * Funkcja tworząca zapowiedź w zakładce Movies
     * @return string
     */
    public function createMoviesPreviewVideo() {
        $entitiesArray = EntityProvider::getMoviesEntities($this->con, null, 1);

        if(sizeof($entitiesArray) == 0) {
            ErrorMessage::show("No movies to display");
        }

        return $this->createPreviewVideo($entitiesArray[0]);
    }

    /**
     * Funkcja tworząca zapowiedź filmu
     * @param $entity
     * @return string
     */
    public function createPreviewVideo($entity){
        if ($entity == null){
            $entity = $this->getRandomEntity();
        }

        $id = $entity->getId();
        $name = $entity->getName();
        $thumbnail = $entity->getThumbnail();
        $preview = $entity->getPreview();

        return "<div class='previewContainer'>

                    <img src='$thumbnail' class='previewImage' hidden>

                    <video autoplay muted class='previewVideo' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'>
                    </video>
                    
                    <div class='previewOverlay'>
                    
                        <div class='mainDetails'>
                            <h3>$name</h3>
                            
                            <div class='buttons'>
                                <button><i class='fas fa-play'></i> Play</button>
                                <button onclick='volumeToggle(this)'><i class='fas fa-volume-mute'></i></button>
                            </div>
                            
                        </div>
                    </div>
        
                </div>";
    }

    /**
     * Funkcja umieszcająca zapowiedź filmu w odpowiednim miejscu na stronie
     * @param $entity
     * @return string
     */
    public function createEntityPreviewSquare($entity){
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $name = $entity->getName();

        return "<a href='entity.php?id=$id'>
                    <div class='previewContainer small'>
                        <img src='$thumbnail' title='$name'>    
                    </div>
                 </a>";
    }

    /**
     * Funkcja wyświetlająca losowe zapowiedzi
     * @return mixed
     */
    private function getRandomEntity(){
        $entity = EntityProvider::getEntities($this->con, null, 1);
        return $entity[0];
    }
}