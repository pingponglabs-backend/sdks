<?php

namespace PingPong\Deployments;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use PingPong\HttpClient\HttpClient;

require '../vendor/autoload.php';

const COMPLETE = 'complete';
const FAILED = 'failed';
const ETA = 180;

class Deployments
{
    private HttpClient $client;

    function __construct(HttpClient $client)
    {   
        $this->client = $client;
    }

    /**
     * @throws Exception
     */
    private function deploymentFactory(array $response): Deployment
    {
        $j = $response['job'];

        if (empty($j)) {
            throw new Exception('Job is empty');
        }

        $job = new Job($j['files'], $j['credits_used']);
        return new Deployment($response['name'], $response['model_id'], $job);
    }

    /**
     * @throws Exception|GuzzleException
     */
    public function create(DeploymentInput $deploymentInput): Deployment
    {
        try {
            $responseData = $this->client->post("/api/v1/deployments", $deploymentInput);


            $deployment = new Deployment(
                $responseData['name'],
                $responseData['model_id'],
                $responseData['status'],
                new Job(
                    $responseData['job']['files'],
                    0,
                    $responseData['job']['eta'],
                    $responseData['job']['status']
                ),
                $responseData['job_id'],
            );
            
            if (isset($response['job']['eta']) && $response['job']['eta'] !== null) {
                $eta = $response['job']['eta'];
            } else {
                $eta = ETA;
            }

            $status = $deployment->getStatus();
            $jobId = $responseData['job_id'];

            while ($status !== COMPLETE && $status !== FAILED && $eta > 0) {
                sleep(10);
                $jobData = $this->client->get("/api/v1/jobs/" . $jobId);

                $job = new Job(
                    $jobData['files'],
                    $jobData['credits_used'],
                    $jobData['eta'],
                    $jobData['status']
                );

                $status = $jobData['status'];
                $deployment->setJob($job);
                $deployment->setStatus($status);
                $eta -= 5;
            }
            return $deployment;
        } catch (GuzzleException $e) {
            throw new Exception('HTTP request failed: ' . $e->getMessage(), $e->getCode(), $e);
        } catch (Exception $e) {
            throw new Exception('An error occurred: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function getById(string $id): Deployment
    {
        $response = $this->client->get('/api/v1/deployments/' . $id);

        return $this->deploymentFactory($response);
    }

    public function getJob(string $id): Job
    {
        $response = $this->client->get('/api/v1/jobs/' . $id);

        return $this->$response;
    }
}