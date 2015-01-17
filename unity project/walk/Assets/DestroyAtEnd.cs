using UnityEngine;
using System.Collections;

public class DestroyAtEnd : MonoBehaviour {

	public Transform player;

	// Use this for initialization
	void Start () {
		player = GameObject.Find("OVRPlayerController").transform;
	}

	// Update is called once per frame
	void Update () {

		if(transform.position.z < player.transform.position.z - 20)
		{
			Destroy(gameObject);
		}


	}
}
