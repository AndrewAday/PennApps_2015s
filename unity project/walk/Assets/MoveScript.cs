using UnityEngine;
using System.Collections;

public class MoveScript : MonoBehaviour {

	public Vector3 speed = new Vector3(10, 10,10);

  	public Vector3 direction = new Vector3(0,0,1);

  	private Vector3 movement;

	// Use this for initialization
	void Start () {

	}

	// Update is called once per frame
	void Update () {
		// var player = GameObject.FindWithTag("ThePlayer");
		// PlayerScript ps = player.GetComponent<PlayerScript>();
		movement = new Vector3(speed.x * direction.x,speed.y * direction.y,speed.z * direction.z);
		//Debug.Log("iswalk" + ps.timeThing);
	}

	void FixedUpdate()
  	{
    // Apply movement to the rigidbody
    	rigidbody.velocity = movement;
  	}
}
