using UnityEngine;
using System.Collections;

public class CubeFall : MonoBehaviour {

	// Use this for initialization
	void Start () {
		GetComponent<Animator>().speed = 0.8f + (Random.value * 0.2f);
	}

	// Update is called once per frame
	void Update () {

	}
}
