<?php

namespace Tests\Unit;

use App\Http\Controllers\ChatController;
use App\Http\Repositories\ChatRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    public function testTrueIsTrue()
    {
        $this->assertTrue(true);
    }

    public function testIndexMethodReturnsCorrectView()
    {
        $response = $this->get(view('chat.index'));
        $response->assertStatus(200);
        $response->assertViewIs('chat.index');
    }

    public function testStoreMethodRedirectsToIndex()
    {
        // Créer un mock du repository
        $mockRepository = Mockery::mock(ChatRepository::class);

        // Injecter le mock du repository dans le contrôleur
        $controller = new ChatController($mockRepository);

        // Créer une fausse requête avec les données que vous souhaitez tester
        $requestData = [
            'pseudo' => 'test pseudo',
            'message' => 'test message',
            // autres champs...
        ];

        $request = new Request($requestData);

        // Définir l'attente sur la méthode store du repository
        $mockRepository
            ->shouldReceive('store')
            ->once()
            ->with(Mockery::on(function ($arg) use ($requestData) {
                return $arg instanceof Request &&
                       $arg->input('pseudo') === $requestData['pseudo'] &&
                       $arg->input('message') === $requestData['message'];
                // Ajoutez d'autres conditions pour les autres champs si nécessaire
            }));

        // Appeler la méthode store du contrôleur
        $response = $controller->store($request);

        // Vérifier que la réponse est une instance de RedirectResponse
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);

        // Extraire l'URL de redirection de la réponse
        $redirectUrl = $response->getTargetUrl();

        // Vérifier que l'URL de redirection correspond à la route 'Chat.index'
        $this->assertEquals(view('chat.index'), $redirectUrl);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close(); // Fermer les mocks pour éviter les fuites de mémoire
    }

}
