<?php

namespace App\Twig\Components;

use App\Form\RegisterFormType;
use ReCaptcha\ReCaptcha;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class RegisterComponent extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;


    public function __construct(
        private readonly ReCaptcha $reCaptcha,
        private readonly UrlGeneratorInterface $router
    )
    {

    }

    #[LiveProp(writable: true)]
    public ?string $captchaToken = null;

    #[LiveProp]
    public array $captchaErrorCodes = [];

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(RegisterFormType::class);
    }

    public function hasValidationErrors(): bool
    {
        return $this->getForm()->isSubmitted() && !$this->getForm()->isValid();
    }

    #[LiveAction]
    public function save(): Response
    {
        $this->captchaErrorCodes = [];

        $this->submitForm();

        $response = $this->reCaptcha
            ->setExpectedHostname($this->router->getContext()->getHost())
            ->verify($this->captchaToken);

        if (!$response->isSuccess()) {
            $this->captchaErrorCodes = $response->getErrorCodes();
        }

        if (!empty($this->captchaErrorCodes)) {
            throw new UnprocessableEntityHttpException('Captcha Validation Error');
        }

        return $this->redirectToRoute('login');
    }
}