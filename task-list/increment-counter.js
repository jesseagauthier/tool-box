const { context, GitHub } = require('@actions/github');

const octokit = new GitHub(process.env.GITHUB_TOKEN);

async function run() {
    const repo = context.repo.repo;
    const owner = context.repo.owner;

    // Get the current counter value
    const response = await octokit.repos.getContent({
        owner,
        repo,
        path: 'counter.txt',
    });

    const currentCounter = Buffer.from(response.data.content, 'base64').toString();
    console.log(`Current counter: ${currentCounter}`);

    // Increment the counter
    const newCounter = parseInt(currentCounter, 10) + 1;
    console.log(`New counter: ${newCounter}`);

    // Update the counter file
    await octokit.repos.createOrUpdateFileContents({
        owner,
        repo,
        path: 'counter.txt',
        message: 'Increment counter',
        content: Buffer.from(newCounter.toString()).toString('base64'),
        sha: response.data.sha,
    });
}

run().catch((error) => {
    console.error(error);
    process.exit(1);
});
