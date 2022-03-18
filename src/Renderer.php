<?php

namespace Source;

class Renderer
{
  public function __construct(private string $viewPath, private ?array $data)
  {
  }

  /**
   * @return view php file
   */
  public function view(): string|false
  {
    ob_start();

    if (isset($this->data)) {
      extract($this->data);
    }

    require Constant::BASE_VIEW_PATH . $this->viewPath . '.php';


    return ob_get_clean();
  }

  /** Construct the view
   * @param string $viewPath
   * exemple: "home/index"
   * @param array $data (optional)
   * @return Renderer view()
   */
  public static function make(string $viewPath, ?array $data = null): static
  {
    return new static($viewPath, $data);
  }

  public function __toString()
  {

    return $this->view();
  }
}
